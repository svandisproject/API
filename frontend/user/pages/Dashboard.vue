<template lang="html">
  <section class="dashboard">
    <div uk-grid class="uk-child-width-1-4 uk-grid-small uk-grid-match rates">
        <div>
            <ui-card size="small">
                <h3 slot="header">ETH/BTC</h3>
                <div class="rate short">
                    {{ rates.btcEth }}
                </div>
            </ui-card>
        </div>
        <div>
            <ui-card size="small">
                <h3 slot="header">SVN/ETH</h3>
                <div class="rate long">
                    {{ rates.svnEth }}
                </div>
            </ui-card>
        </div>
        <div>
            <ui-card size="small">
                <h3 slot="header">BTC/USD</h3>
                <div class="rate short">
                    {{ rates.btcUsd }}
                </div>
            </ui-card>
        </div>
        <div>
            <ui-card size="small">
            <ui-position center><ui-icon i="plus"  class="uk-icon-button"></ui-icon></ui-position>
            </ui-card>
        </div>
    </div>
    <highcharts :options="options" ref="highcharts"></highcharts>
    <highcharts-renderer :width="0" :height="0" ref="highchartsRenderer"></highcharts-renderer>

    <ui-card>
        <h3 slot="header">News feed
            <div>
                  <ui-icon i="settings"/>
                  <div uk-drop="mode: click">
                    <ui-card size="small">
                        <div class="uk-inline">
                            <form class="uk-form">
                               <input
                               placeholder="Keyword"
                               v-model="keyword"
                               class="uk-input uk-form-small"
                               v-on:keyup.enter="filter()">
                            </form>
                        </div>
                    </ui-card>
                  </div>
            </div>
        </h3>
        <dl class="uk-description-list uk-description-list-divider">
            <template v-for="post in posts">
                <dt>{{post.title}}</dt>
                <dd>
                <div>{{post.content.substr(0, 300)}}...</div>
                <span>
                    <span class="uk-label" v-for="tag in post.tags">tag.title</span>
                </span>
                <p class="uk-text-meta">
                    <span><ui-icon i="world"/>&nbsp;{{post.source}}</span>
                    <span>
                        <ui-icon i="clock"/>&nbsp;<timeago :since="post.published_at"></timeago>
                    </span>
                    <span>
                        <ui-icon i="tag"/>&nbsp;
                        <span class="uk-label uk-label-success">
                            {{ tags[Math.floor(Math.random()*tags.length)] }}
                        </span>
                    </span>
                </p>
                </dd>
            </template>
        </dl>
    </ui-card>
    <div class="uk-section" v-if="$auth.authenticated()">
        <div class="uk-container">
            <footer>
                <logo></logo>
                <p>&copy; svandis.io {{(new Date()).getFullYear()}}</p>
            </footer>
        </div>
    </div>
   </section>
</template>

<script lang="js">
  import fixtures from '../fixtures/data'
  import Logo from '../components/Logo'
  export default  {
    name: 'dashboard',
    data() {
        return {
            rates: {
                btcEth: Math.round(Math.random()*100)/100,
                svnEth: Math.round(Math.random()*100)/100,
                btcUsd: Math.round(Math.random()*2000000)/100,
                ethUsd: Math.round(Math.random()*15000)/100,
            },
            options: {
                chart: {
                    type: 'candlestick'
                },
                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'SVN/ETH'
                },

                series: [{
                    type: 'candlestick',
                    name: 'SVN/ETH',
                    data: fixtures,
                    dataGrouping: {
                        units: [
                            [
                                'week', // unit name
                                [1] // allowed multiples
                            ], [
                                'month',
                                [1, 2, 3, 4, 6]
                            ]
                        ]
                    }
                }]
            },
            keyword: '',
            posts: [],
            tags: [
                'Bitcoin', 'Etherum', 'Altcoins', 'Svn'
            ]
        }
    },
    props: [],
    methods: {
        filter() {
            this.$store.commit('SET_KEYWORD', this.keyword)
            this.getData()
        },
        getData() {
            let url = '/api/website-post/filter?sort=published_at&order=desc&limit=20'
            if(this.$store.getters.getKeyword !== '') {
                url += '&title=' + this.$store.getters.getKeyword
            }
            this.$axios.get(url)
                .then((response) => {
                    this.posts = response.data.rows
                })
        }
    },
    components: {
        Logo
    },
    mounted() {
        this.keyword = this.$store.getters.getKeyword
        this.getData();
    }
}
</script>

<style scoped lang="scss">
  .dashboard {
      h3 {
         div {
             float: right;
             cursor: pointer;
         }
      }
    .rates {
        margin-bottom: 2rem;
    }
    .rate {
        font-size: 2rem
    }
    .short {
        color: red;
    }
    .long {
        color: green;
    }
    .uk-text-meta {
    }
    footer {
          max-height: 100px;
          text-align: center;
          .logo {
              max-height: 100px;
          }
      }
  }
</style>
