const Crawler       = require('simplecrawler');
const cheerio       = require('cheerio');
const redis = require('redis');
const config = require('../config');
const STATUS_SUCCESS = 1;

let instance = {
    execute(task, axios) {
        let redisClient = redis.createClient();
        let crawler = Crawler(task.url);
        crawler.maxDepth = 3;
        crawler.maxConcurrency = 3;

        crawler.discoverResources = function(buffer, queueItem) {
            var $ = cheerio.load(buffer.toString("utf8"));

            return $("a[href]").map(function () {
                return $(this).attr("href");
            }).get();
        };

        // crawler.addFetchCondition( function(queueItem) {
        //     callback(null, !redisClient.get(queueItem.url));
        // });

        crawler.on("fetchcomplete", function(queueItem, responseBuffer, response, body) {
                let data = {};
                console.log('Fetched item')
                let $ = cheerio.load(responseBuffer.toString());
                    data.url     = queueItem.url;
                    data.title   = $(task.config.titleSelector).text();
                    data.content = $(task.config.contentSelector).text();
                    data.source  = task.url;
                    if(task.config.publishedAtRegexp) {
                        let date = $(task.config.publishedAtSelector).text().match(task.config.publishedAtRegexp);
                        console.log($(task.config.publishedAtSelector).text());
                        if(date && date.length === 5) {
                            data.date = new Date()
                                .parse(date[0] + ' ' + date[1] + ', ' + date[2] + ' ' + date[3]+':'+date[4])
                        }

                    } else {
                        data.date = $(task.config.publishedAtSelector).text()
                    }

                    console.log(data);
                    if(data.url && data.title && data.content && data.source && data.date) {
                    axios.post(config.API_URL + '/api/website-post', { 'website-post': data })
                        .then(function(response) {
                            redisClient.set(queueItem.url, STATUS_SUCCESS)
                        })
                        .catch(function(error) {
                            console.log(error.response.headers)
                            console.log(error.response.data);
                            console.log((error.response.status + ' ' + error.response.statusText).red)
                        })
                    ;
                    }
            });



        crawler.start();

    }
}

module['exports'] = instance;