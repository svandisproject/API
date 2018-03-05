const Twitter = require('twitter');

let instance = {
    execute(task, axios) {
        console.log(task.config);
        let client = new Twitter({
            consumer_key: task.config.consumerKey,
            consumer_secret: task.config.consumerSecret,
            access_token_key: task.config.accessTokenKey,
            access_token_secret: task.config.accessTokenSecret
        });

        let params = {screen_name: 'SvTestBot'};
        client.get('statuses/user_timeline', params, function(error, tweets, response) {
            if(error) {
                console.log(error)
            }
            if (!error) {
                console.log(tweets);
            }
        });
    }
};

module['exports'] = instance;