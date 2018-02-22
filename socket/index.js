var io = require('socket.io')();
var jwt = require('jsonwebtoken');
var secret;
const fs = require('fs');

fs.readFile('public.pem', 'utf8', function(err, data) {
    if (err) throw err;
    secret = data;

    io.use(function (socket, next) {
        var token = socket.handshake.query.token,
            decodedToken;
        if(token) {
            try {
                decodedToken = jwt.verify(token, secret);
                socket.connectedUser = decodedToken;
                next();
            } catch (err) {
                console.error(err);
                next(new Error("Token is not valid"));
                socket.disconnect();
            }
        }
        next();
    });

    console.log('Server started');
    io.listen(1337);
});

io.on('connection', (client) => {
    console.log('Client connected...');
    // console.log(client.connectedUser)
});

setInterval(() => {
    console.log('Crawl task emitted')
    io.emit('worker-crawl-task', {
        name: 'web',
        url: 'https://www.coindesk.com/',
        config: {

        }
    })
}, 60000)