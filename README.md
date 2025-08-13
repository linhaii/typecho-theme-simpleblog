# simpleblog - 简约而不简陋的 Typecho 主题

simpleblog 是一个简约、优雅且功能丰富的 Typecho 主题，专注于内容展示和阅读体验。

## 主题特点

- **简约设计**：极简主义设计风格，让内容成为焦点
- **响应式布局**：完美适配桌面端和移动端设备
- **自定义侧边栏**：可自定义侧边栏背景颜色
- **社交媒体集成**：支持 Twitter、Facebook、GitHub 等社交媒体链接
- **特色图片支持**：通过自定义字段实现特色图片功能
- **文章摘要**：支持自定义文章摘要
- **按年份归档**：首页文章按年份分组显示
- **搜索功能**：内置搜索功能，方便查找内容
- **评论系统**：美观的评论布局和样式

## 安装方法

1. 下载主题压缩包
2. 解压后将文件夹重命名为 `simpleblog`
3. 上传到 Typecho 的 `/usr/themes/` 目录下
4. 登录 Typecho 后台，进入「外观」，启用 simpleblog 主题

## 主题配置

在 Typecho 后台 → 外观 → 设置外观 中，可以进行以下配置：

### 基本设置

- **侧边栏背景颜色**：设置桌面端侧边栏和移动端顶部的背景颜色，使用十六进制颜色代码

### 社交媒体设置

- **Twitter 链接**：填入您的 Twitter 个人资料链接
- **Facebook 链接**：填入您的 Facebook 个人资料链接
- **GitHub 链接**：填入您的 GitHub 个人资料链接

## 特殊功能使用说明

### 特色图片

Typecho 默认没有特色图片功能，本主题使用自定义字段来实现。在编辑文章时，添加自定义字段：

- 字段名：`thumbnail`
- 字段值：图片的 URL 地址

### 文章摘要

在编辑文章时，添加自定义字段：

- 字段名：`excerpt`
- 字段值：文章摘要内容

### 文章置顶

需配合我修改的文章置顶插件使用。

**注意：**插件设置中“置顶标记的 HTML”**切勿**修改，否则将无法显示主题内置的置顶文章样式。

## 文件结构

```
simpleblog/
├── 404.php            # 404 错误页面
├── archive.php        # 归档页面
├── comments.css       # 评论样式
├── comments.php       # 评论模板
├── footer.php         # 页脚模板
├── functions.php      # 主题函数
├── header.php         # 页头模板
├── index.php          # 首页模板
├── page.php           # 独立页面模板
├── pagination.php     # 分页模板
├── post.php           # 文章页面模板
├── README.md          # 主题说明文档
├── screenshot.png     # 主题预览图
├── search.php         # 搜索结果页面
├── style.css          # 主题样式表
├── assets/            # 资源文件夹
├── css/               # CSS 文件夹
├── fonts/             # 字体文件夹
├── images/            # 图片文件夹
└── js/                # JavaScript 文件夹
```

## 浏览器兼容性

simpleblog 主题兼容所有现代浏览器，包括：

- Chrome
- Firefox
- Safari
- Edge
- Opera

## 许可证

本主题基于 GNU General Public License v2.0 许可证发布。

## 作者信息

- 原主题作者：Anders Norén
- 移植作者：林海草原
- 作者网站：[https://lhcy.org](https://lhcy.org)

## 更新日志

### 1.0 (初始版本)
- 初始版本发布

## 常见问题

**Q: 如何设置特色图片？**  
A: 在编辑文章时，添加自定义字段 `thumbnail`，值为图片 URL。

**Q: 如何添加文章摘要？**  
A: 在编辑文章时，添加自定义字段 `excerpt`，值为摘要内容。

**Q: 如何修改侧边栏颜色？**  
A: 在主题设置中修改「侧边栏背景颜色」选项。

## 支持与反馈

如有问题或建议，请访问作者网站 [https://lhcy.org](https://lhcy.org) 获取支持。