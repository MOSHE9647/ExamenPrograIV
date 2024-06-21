<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<style>
#app {
    margin: 0px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
        'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
        sans-serif;
    text-align: center;
    margin-bottom: 40px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

code {
    font-family: source-code-pro, Menlo, Monaco, Consolas, 'Courier New',
        monospace;
}

router-view {
    text-align: center;
    margin-bottom: 40px;
}

.col-md-4,
.col-md-6,
.col-md-12 {
    padding: 20px;
}

.col-md-4,
.col-md-6,
.col-md-12 label {
    padding: 10px;
    text-align: left;
}

.btn {
    margin: 10px;
}

a {
    text-decoration: none;
    font-size: 1.3rem;
    text-align: center;
    height: 35px;
}

a:hover {
    text-decoration: underline;
}

table {
    align-items: center;
}
</style>
