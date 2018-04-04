const snoowrap = require('snoowrap');

let instance = {
    execute(task, axios) {
        console.log(task.config);
        let client = new snoowrap({
            userAgent: task.config.userAgent,
            clientId: task.config.clientId,
            clientSecret: task.config.clientSecret,
            username: task.config.userName,
            password: task.config.userPassword
        });

        let params = {screen_name: task.config.username};

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