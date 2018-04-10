const snoowrap = require('snoowrap');
const axios = require('axios');
const config  = require('../config');


let instance = {
    execute(task, axios) {
        console.log(task.config);


        let r = new snoowrap({
            userAgent: 'reddit-crawler-example-app',
            clientId: task.config.clientId,
            clientSecret: task.config.clientSecret,
            username: task.config.userName,
            password: task.config.userPassword
        });

        r.getNew()
            .then(
                getNewRedditArr
            )
            .then(
                mainWork
            );

        function getNewRedditArr(listing){
            let reditArr = [];
            listing.map(e => reditArr.push({title: e.title, url: e.url, content: e.id, source: 'reddit', publishedAt: dateTimeConverter(e.created_utc)}));
            return reditArr;
        }

        function mainWork(newRedditArr) {
            // get id list from DB
            axios.get(config.API_URL + '/api/post/filter?source=reddit&sort=id')
                .then(
                    response => {
                        getNewestRedditPosts(response, newRedditArr)
                    }
                )
                .catch(
                    e => {
                        console.error(e)
                    }
                );
        }

        function getNewestRedditPosts(response, newRedditArr){
            let arrIssetIds = [];
            if(response.data.total > 0){
                response.data.rows.map(item => arrIssetIds.push(item.content))
            }

            newRedditArr.map(post =>{
                // console.log(item.content)
                if(arrIssetIds.indexOf(post.content) === -1){
                    // console.log(item)
                    sendData(post);
                }
            });
        }

        function dateTimeConverter(utc_format) {
            return new Date(utc_format * 1000);
        }
        function sendData(obj) {
            axios.post(config.API_URL + '/api/post', {'post': obj})
                .catch(
                  e => console.error(e)
                );
        }
    }

};

module['exports'] = instance;