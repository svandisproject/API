var io = require('socket.io')();

io.on('connection', (client) => {
    console.log(client)
});
console.log('Server started');


io.on('message', )

io.listen(3000);