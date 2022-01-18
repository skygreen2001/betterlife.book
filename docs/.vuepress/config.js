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
    ['meta', { name: 'theme-color', content: '#3eaf7c' }], // default: #3eaf7c
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
    displayAllHeaders: false,
    // activeHeaderLinks: false,
    nav: [
      {
        text: '介绍',
        link: '/index/',
      },
      {
        text: '教程',
        link: '/core/',
      },
      {
        text: '高级',
        link: '/ace/',
      },
      {
        text: '部署',
        link: '/deploy/',
      },
      // {
      //   text: 'Github',
      //   link: 'https://github.com/skygreen2001/betterlife.book'
      // }
    ],
    sidebar: {
      '/index/': [
        {
          title: '介绍',
          collapsable: false,
          children: [
            '',
          ]
        }
      ],
      '/quickstart/': 'auto',
      '/core/': gettSidebarTutorial(),
      '/ace/': gettSidebarAce(),
      '/deploy/': getSideDeploy(),
      '/learn/': 'auto',
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
  return [
    '',
    {
      title: '原型设计',
      collapsable: true,
      children: [
        ['database/', '设计规范'],
        ['database/database_define', '数据库定义'],
        ['database/sql', 'SQL查询'],
        ['database/example', '数据库示例'],
        ['database/databasetools', '数据库小工具'],
        ['database/alltypedb', '各种数据库'],
      ]
    },
    {
      title: '数据对象',
      collapsable: true,
      children: [
        ['dataobject/', '介绍'],
        ['dataobject/dataobjectspec', '规格说明'],
        ['dataobject/normalmethod', '通用方法'],
        ['dataobject/dataobjectdetail', '详细说明'],
        ['dataobject/dataobjectsample', '示例'],
      ]
    },
    {
      title: '工具集',
      collapsable: true,
      children: [
        ['tools/', '介绍'],
        'tools/toolsclass',
        'tools/toolsfunction',
        ['tools/toolsapi', 'api工具'],
      ]
    },
    {
      title: '框架MVC',
      collapsable: true,
      children: [
        ['mvc/', '介绍'],
        'mvc/model',
        'mvc/controller',
        'mvc/view',
        ['mvc/router', '路由器'],
      ]
    },
    {
      title: '系统工具',
      collapsable: true,
      children: [
        ['system/', '介绍'],
        'system/exception',
        'system/log',
        'system/debug',
      ]
    },
  ]
}

function gettSidebarAce() {
  return [
    '',
    {
      title: '代码生成',
      collapsable: true,
      sidebarDepth: 0,
      children: [
        'autocode/',
        ['autocode/autocodeconfig', '配置文件'],
        'autocode/readyforautocode',
      ]
    },
    {
      title: '报表系统',
      collapsable: true,
      children: [
        'more/report',
      ]
    }
  ]
}

function getSideDeploy() {
  return [
    {
      title: '部署',
      collapsable: true,
      children: [
        '',
        'nginx',
        'lamp',
        'security',
      ]
    },

  ]
}