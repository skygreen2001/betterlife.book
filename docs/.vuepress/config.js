const { description } = require('../../package')

module.exports = {
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#title
   */
  title: 'Betterlife 学习手册',
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#description
   */
  description: description,

  /**
   * Extra tags to be injected to the page HTML `<head>`
   *
   * ref：https://v1.vuepress.vuejs.org/config/#head
   */
  head: [
    ['meta', { name: 'theme-color', content: '#ffffff' }], // default: #3eaf7c
    ['meta', { name: 'apple-mobile-web-app-capable', content: 'yes' }],
    ['meta', { name: 'apple-mobile-web-app-status-bar-style', content: 'black' }]
  ],

  /**
   * Theme configuration, here is the default theme configuration for VuePress.
   *
   * ref：https://v1.vuepress.vuejs.org/theme/default-theme-config.html
   */
  themeConfig: {
    repo: 'skygreen2001/betterlife.book',
    editLinks: true,
    docsDir: 'docs',
    editLinkText: '编辑该页面',
    lastUpdated: false,
    search: true,
    searchMaxSuggestions: 10,
    displayAllHeaders: true,
    // activeHeaderLinks: false,
    nav: [
      {
        text: '快速上手',
        link: '/quickstart/',
      },
      {
        text: '教程',
        link: '/tutorial/',
      },
      {
        text: '工具',
        link: '/tools/',
      },
      // {
      //   text: 'Github',
      //   link: 'https://github.com/skygreen2001/betterlife.book'
      // }
    ],
    sidebar: {
      '/quickstart/': 'auto',
      '/learn/': 'auto',
      '/tutorial/': gettSidebarTutorial (),
      '/tools/': gettSidebarTools (),
    }
  },

  /**
   * Apply plugins，ref：https://v1.vuepress.vuejs.org/zh/plugin/
   */
  plugins: [
    '@vuepress/plugin-back-to-top',
    '@vuepress/plugin-medium-zoom',
  ]
}

function gettSidebarTutorial () {
  return [{
      title: '介绍',
      collapsable: true,
      children: [
        ''
      ]
    },
    {
      title: '数据库原型设计规范',
      collapsable: true,
      children: [
        'database/',
        'database/sql',
        'database/example',
      ]
    },
    {
      title: '数据对象',
      collapsable: true,
      children: [
        'dataobject/',
        'dataobject/normalmethod',
        'dataobject/dataobjectdetail',
        'dataobject/dataobjectspec',
        'dataobject/dataobjectsample',
      ]
    },
    {
      title: '框架介绍',
      collapsable: true,
      children: [
        'core/',
        'core/model',
        'core/controller',
        'core/view',
        'core/router',
      ]
    },
  ]
}

function gettSidebarTools () {
  return [
    {
      title: '工具',
      collapsable: true,
      children: [
        '',
        'toolset',
        'toolsclass',
        'toolsfunction',
        'toolsapi',
        'autocode',
        'autocodeconfig',
        'readyforautocode',
      ]
    }
  ]
}