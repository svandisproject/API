const snoowrap = require('snoowrap');
const axios = require('axios');
const config  = require('../config');

// TODO "and reddit worker"


    let r = new snoowrap({
        userAgent: 'reddit-crawler-example-app',
        clientId: 'M1dPE7ODOp61NQ',
        clientSecret: 'h30ghT9k1G1dzRMKxUEW5AUL_5I',
        username: 'RumusBin',
        password: 24031982
    });

    r.getNew()
        .then(
        listing => work(listing)
    );

    function work(listing){

        console.log(getIssetIds());

            // listing.slice(0).reverse().map(submission => mainWork(submission, 'sum str'));
        }

    function getIssetIds() {
        axios.get(config.API_URL + '/api/post/filter?source=reddit&sort=id')
            .then(
                response => {
                    let arrIssetIds = [];
                    if(response.data.total > 0){
                        response.data.rows.map(item => arrIssetIds.push(item.content))
                    }
                    return arrIssetIds;
                }
            )
            .catch(
                e => {
                    console.error(e)
                }
            );
    }


     function getIssetIdsArr(object){

     }

    function mainWork(e, str) {
         console.log(str)
        // console.log({title: e.title, content: e.id, url: e.url, publishedAt: dateTimeConverter(e.created_utc), source: 'reddit', type: e.link_flair_text});
            // if(checkNewest(e.id)){
            //     console.log({title: e.title, content: e.id, url: e.url, publishedAt: dateTimeConverter(e.created_utc), source: 'reddit', type: e.link_flair_text});
            // }
    }
    function checkNewest(redditIds) {
        let arrIssetIds = getIssetIdsArr();
        if(redditIds in arrIssetIds ){
            return false;
        }return true;
    }

    function dateTimeConverter(utc_format) {
        let dt_format = new Date(utc_format * 1000);
        return dt_format;
    }

let instance = {
    execute(task, axios) {
        console.log(task.config);


        // client.getNew().then(posts => {
        //
        //     }
        // )

    }
};

// module['exports'] = instance;