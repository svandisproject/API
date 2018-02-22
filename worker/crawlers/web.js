var fs            = require('fs');
var Crawler       = require('simplecrawler');
var cheerio       = require('cheerio');
var redis = require('redis');

const STATUS_SUCCESS = 1;

var execute = function(axios) {
    var redisClient = redis.createClient();
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

