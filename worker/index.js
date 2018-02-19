#!/usr/bin/env node

var colors = require('colors');
var args = require('process-argv')({
    enable_commands: true
});
var axios = require('axios');

switch (args.command) {
    case "register":
        registerWorker();
        break;
    case "start":
        startWorker();
        break;
    default:
        break;
}

function registerWorker() {
    if(!args.options.secret) {
        console.log('Secret is required to register worker'.red);
        process.exit(1);
    }
    console.log('Registering worker'.green);
    axios.post();
}

function startWorker() {
    heartbeat();
}

function heartbeat() {
    setTimeout(() => {

    });
}