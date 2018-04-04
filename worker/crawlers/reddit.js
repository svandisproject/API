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


    }
};

module['exports'] = instance;