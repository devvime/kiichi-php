<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiichii PHP Documentation</title>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
      pre {
        background-color: #12101a;
        padding: 20px;
        border-radius: 5px;
        color: #eee;
      }
    </style>
  </head>
  <body>
    <div id="content"></div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        async function loadMarkdown() {
          try {
              const response = await fetch('/doc-data');
              const markdown = await response.text();
              document.getElementById('content').innerHTML = marked.parse(markdown);
          } catch (error) {
              console.error('Erro ao carregar o arquivo Markdown:', error);
          }
        }
        loadMarkdown();
      });
    </script>
  </body>
</html>