const Crawler       = require('simplecrawler');
const cheerio       = require('cheerio');
const redis = require('redis');
const config = require('../config');
const STATUS_SUCCESS = 1;

let crawler = {
    execute(task, axios) {
        let redisClient = redis.createClient();
        let crawler = Crawler(task.url)
            .on("fetchcomplete", function(queueItem, responseBuffer, response, body) {
                let data = {};

                let $ = cheerio.load(responseBuffer.toString());
                    data.url     = queueItem.url;
                    data.title   = $(task.config.titleSelector).text();
                    data.content = $(task.config.contentSelector).text();
                    data.source  = task.url;
                    data.publishedAt = $(task.config.publishedAtSelector).text();
                    
                    axios.post(config.API_URL + '/api/website-post', { 'website-post': data })
                        .then(function(response) {
                            redisClient.set(queueItem.url, STATUS_SUCCESS)
                        })
                        .catch(function(error) {
                            console.log(error.response.data);
                            console.log((error.response.status + ' ' + error.response.statusText).red)
                        })
                    ;
            });

        crawler.maxDepth = 3;
        crawler.addFetchCondition( function(queueItem, referrerQueueItem, callback ) {
            callback(null, !redisClient.get(queueItem.url))
        });

        crawler.start();
    }
}

module['exports'] = crawler;