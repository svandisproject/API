const Twitter = require('twitter');

let instance = {
    execute(task, axios) {
        console.log(task.config);
        let client = new Twitter({
            username: task.config.username,
            consumer_key: task.config.consumerKey,
            consumer_secret: task.config.consumerSecret,
            access_token_key: task.config.accessTokenKey,
            access_token_secret: task.config.accessTokenSecret
        });

        let params = {screen_name: task.config.username};

        client.get('statuses/user_timeline', params, function(error, tweets, response) {
            if(error) {
                console.log(error)
            }
            if (!error) {
                console.log(tweets);
                const allTweets = JSON.parse(tweets);
                for (const tweet in allTweets) {
                    if (allTweets[tweet].id && allTweets[tweet].text && allTweets[tweet].created_at) {
                        const oneTweet = {
                            url: `https://twitter.com/statuses/${allTweets[tweet].id}`,
                            title: allTweets[tweet].text,
                            content: allTweets[tweet].text,
                            source: 'twitter',
                            publishedAt: allTweets[tweet].created_at,
                        };
                        axios.post(`${config.API_URL}/api/post`, { post: oneTweet });
                    }
                }
            }
        });
    }
};

module['exports'] = instance;