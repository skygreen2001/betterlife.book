# 帮助制作静态网站发布

利用VuePress: Vue 驱动的静态网站生成器制作[betterlife书籍](https://github.com/skygreen2001/betterlife.book)的静态网站发布静态网站，对外公开介绍betterlife框架

## 制作静态网站
  - VuePress
    ```
    yarn install
    yarn dev
    ```
  - 发布到[Netlify](https://docs.netlify.com/configure-builds/common-configurations/#vuepress)
    ```
    yarn build
    ```
    - 发布目录地址: docs/.vuepress/dist

## 参考

  - [CommonMark Spec](https://spec.commonmark.org/)
  - [GitHub Flavored Markdown Spec](https://github.github.com/gfm/)
  - [VuePress](https://vuepress.vuejs.org/zh/): Vue 驱动的静态网站生成器
  - [VuePress](https://vuepress.vuejs.org): Vue-powered Static Site Generator
  - [Netlify](https://www.netlify.com)
    - 提供免费静态网站
    - [Netlify](https://en.wikipedia.org/wiki/Netlify)
  - [netlifycms](https://www.netlifycms.org/)