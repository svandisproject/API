var io = require('socket.io')();

io.on('connection', (client) => {
    console.log(client)
});
console.log('Server started');

io.listen(1337);