const snoowrap = require('snoowrap');

let instance = {
    execute(task, axios) {
        console.log(task.config);
        let client = new snoowrap({
            userAgent: request.headers['user-agent'],
            clientId: task.config.clientId,
            clientSecret: task.config.clientSecret,
            username: task.config.userName,
            password: task.config.userPassword
        });

        // client.getNew().then(posts => {
        //
        //     }
        // )

    }
};

module['exports'] = instance;