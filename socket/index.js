const io = require('socket.io')();
const jwt = require('jsonwebtoken');
const axios = require('axios');
const colors = require('colors')
const config = require('./config');
const STATUS_FREE = 0;
const STATUS_BUSY = 1;
const fs = require('fs');

let workerPool = [];


fs.readFile('public.pem', 'utf8', function(err, key) {
    if (err) throw err;
    io.use(function (socket, next) {
        let token = socket.handshake.query.token,
            decodedToken;
        if(token) {
            try {
                decodedToken = jwt.verify(token, key);
                socket.connectedUser = decodedToken;
                next();
            } catch (err) {
                console.error(err);
                next(new Error("Token is not valid"));
                socket.disconnect();
            }
        }
        let secret = socket.handshake.query.secret;
        if(secret) {
            axios.post(config.API_URL + '/worker/authenticate', {
                secret: secret
            })
                .then((response) => {
                    if(socket.handshake.address.indexOf(response.data.host) > -1) {
                        console.log("Worker attached to pool".green)
                        workerPool.push({
                            status: STATUS_FREE,
                            id: socket.id,
                            secret: secret
                        });
                        next()
                    } else {
                        console.error("Worker host does not match!");
                        socket.disconnect();
                    }
                })
                .catch((error) => {
                    console.error(err);
                    next(new Error("Secret is not valid"));
                    socket.disconnect();
                })
        }
        next();
    });

    console.log('Server started');
    io.listen(1337);
});

io.on('connection', (client) => {
    console.log('Client connected'.green);

    io.on('disconnected', (socket) => {
        console.log('Client disconnected'.red)
        let index = workerPool.findIndex((worker) => {
            return worker.id = socket.id
        });
        if(index > -1) {
            workerPool.splice(index);
        }
    })
});

io.on('worker-finished-task', (secret) => {
    workerPool.map((worker) => {
        if(worker.secret === secret) {
            worker.status = STATUS_FREE
        }
    })
});


setInterval(() => {
    console.log('Crawl task emitted');
    for(let i in workerPool) {
        if(workerPool[i].status === STATUS_FREE) {
            console.log('Found free worker'.green)
            io.to(workerPool[i].id).emit('worker-crawl-task', {
                name: 'web',
                url: 'https://www.coindesk.com/',
                config: {
                    titleSelector: 'h3.article-top-title',
                    contentSelector: '.article-content-container',
                    publishedAtSelector: '.article-container-left-timestamp'
                }});
            workerPool[i].status = STATUS_BUSY;
            break;
        }
    }
}, 10000)