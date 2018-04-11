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
                response=>{
                    let newRedditPosts = [];
                    response.map(e => newRedditPosts.push({title: e.title, url: e.url, content: e.id, source: 'reddit', publishedAt: e.created_utc}));
                    return newRedditPosts;
                }
            )
            .then(
                lastPosts => {
                    // get id list from DB
                    axios.get(config.API_URL + '/api/post/filter?source=reddit&sort=id')
                        .then(
                            response => {
                                let existingPosts =  response.data.rows.map(row => row.content);
                                lastPosts.map(post =>{
                                    if(existingPosts.indexOf(post.content) === -1){
                                        axios.post(config.API_URL + '/api/post', {'post': obj})
                                            .catch(
                                                e => console.error(e)
                                            );
                                    }
                                });
                            }
                        )
                        .catch(
                            e => {
                                console.error(e)
                            }
                        );
                }
            );
    }

};

module['exports'] = instance;