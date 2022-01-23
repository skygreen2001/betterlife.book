# 帮助制作静态网站发布

利用VuePress: Vue 驱动的静态网站生成器制作[betterlife书籍](https://github.com/skygreen2001/betterlife.book)的静态网站发布静态网站，对外公开介绍betterlife框架

## 制作静态网站

### 使用VuePress制作静态网站
  - VuePress
    ```
    yarn install
    yarn dev
    ```
### 编译发布静态网站
  - 生成网站
    ```
    yarn build
    ```
    - 发布目录地址: docs/.vuepress/dist

### 部署到`Github Page`
  - [学习手册](https://skygreen2001.github.io)
  - 发布到[Github Page](https://vuepress.vuejs.org/guide/deploy.html#github-pages)
  - Github Page
    ```
    ./deploy.sh
    ```
  - GitHub Pages and Travis CI
    - 体验不好，未实践成功
    - 需要上传yarn.lock。

### 部署到`Netlify`
  - [学习手册: 在Netlify](https://skygreen2001.netlify.app)
  - 发布到[Netlify](https://vuepress.vuejs.org/guide/deploy.html#netlify)
  - [Netlify Common configurations](https://docs.netlify.com/configure-builds/common-configurations/#vuepress)

## 部署到`Vercel`
  - [学习手册: 在Vercel](https://skygreen2001.vercel.app/)
  - 发布到[Vercel](https://vuepress.vuejs.org/guide/deploy.html#heroku)

### 部署到`Surge`
  - [学习手册: 在Surge](https://skygreen2001.surge.sh/)
  - 发布到[Surge](https://vuepress.vuejs.org/guide/deploy.html#surge)
  - 安装surge: npm install --global surge
  - 生成网站: yarn build 
  - 部署到Surge: surge docs/.vuepress/dist

### 部署到`Heroku`
  - [学习手册: 在Heroku](https://skygreen2001.herokuapp.com)
  - 发布到[Heroku](https://vuepress.vuejs.org/guide/deploy.html#heroku)
  - [安装Heroku](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)
    ```
    brew tap heroku/brew && brew install heroku
    ```
  - 登录Heroku: heroku login
  - 创建一个文件: static.json
    ```
    {
      "root": "./docs/.vuepress/dist"
    }
    ```
  - 在Heroku创建App: heroku apps:create skygreen2001
  - 设置buildpack: heroku buildpacks:set https://github.com/heroku/heroku-buildpack-static.git
  - 修改.gitignore文件: 注释掉dist, 即允许提交 docs/.vuepress/dist
  - 提交: git add . && git commit -m "commit for heroku"
  - 在Heroku发布App: git push heroku master
  - 发布完成后，需恢复提交还原，还原.gitignore文件: dist, 即在master分支上不提交dist文件夹

## 参考

  - [CommonMark Spec](https://spec.commonmark.org/)
  - [GitHub Flavored Markdown Spec](https://github.github.com/gfm/)
  - [VuePress](https://vuepress.vuejs.org/zh/): Vue 驱动的静态网站生成器
  - [VuePress](https://vuepress.vuejs.org): Vue-powered Static Site Generator
  - [VuePress Deploying](https://vuepress.vuejs.org/guide/deploy.html)
  - [Netlify](https://www.netlify.com): 提供免费静态网站
    - [Wiki Netlify](https://en.wikipedia.org/wiki/Netlify)
  - [netlifycms](https://www.netlifycms.org/)
  - [Heroku](https://devcenter.heroku.com/): building, deploying, and managing your apps
  - [surge](https://surge.sh): Static web publishing for Front-End Developers