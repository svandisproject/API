var fs            = require('fs');
var Crawler       = require('simplecrawler');
var cheerio       = require('cheerio');
var axios         = require('axios');
var cacheFilePath = __dirname + '/var/parse/coindesk';


const apiURL       = 'http://localhost/';
const clientId     = '1_52xz0po6j84c4cw0osc0ss84gk8k8sk8ksw00scckgoswg4s44';
const clientSecret = '2wi27ilxedk4ks8go08w448g400g4w0kc0cwsg4c840w4w8kw4';
const username     = 'api';
const password     = 'btcapipassword123';

axios.get(apiURL +
    'oauth/v2/token?' +
    'grant_type=password' +
    '&client_id=' + clientId +
    '&client_secret=' + clientSecret +
    '&username=' + username +
    '&password=' + password)
    .then(function(response) {
        var token = response.data.access_token;
        axios.defaults.headers.common['X-AUTH-TOKEN'] = token;
        fs.stat(cacheFilePath, function(err) {
            fs.writeFile(cacheFilePath, '', function(err) {
                if (err) throw err;
            });

            fs.readFile(cacheFilePath, function (err, data) {
                if (err) throw err;
                var crawled = data.toString().split('\n');
                var stream = fs.createWriteStream(cacheFilePath);
                stream.once('open', function(fd) {
                    crawl(crawled, stream, token)
                });

            });
        });

    }).catch(function (error) {
    console.log(error.response.status, error.response);
    process.exit(0);
});
var crawl = function(crawled, stream, token) {
    var crawler = Crawler("https://www.coindesk.com/")
        .on("fetchcomplete", function(queueItem, responseBuffer, response, body) {
            var data = {};

            var $ = cheerio.load(responseBuffer.toString());
            if($('body').hasClass('single-post')) {

                data.url     = queueItem.url
                data.title   = $('h3.article-top-title').text();
                data.content = $('.article-content-container').text();
                data.source  = 'Coindesk';
                data.publishedAt = $('meta[property="article:published_time"]')[$('meta[property="article:published_time"]').length - 1].attribs.content;
                axios.post(apiURL + 'api/content', { content: data })
                    .then(function(response){
                        stream.write(queueItem.url + '\n');
                    })
                    .catch(function(error){
                        console.log(error.response.status + ' ' + error.response.statusText)
                    })
                ;
            } else {
                stream.write(queueItem.url + '\n');
            }
        });

    crawler.maxDepth = 3;
    crawler.addFetchCondition( function(queueItem, referrerQueueItem, callback ) {
        callback(null, crawled.indexOf(queueItem.url) === -1)
    });

    crawler.start();
};

