import './doc.scss'

export const doc = () => {
  document.addEventListener("DOMContentLoaded", () => {
    async function loadMarkdown() {
      try {
          const response = await fetch('/doc-data');
          const markdown = await response.text();
          document.getElementById('content').innerHTML = marked.parse(markdown);
          document.querySelectorAll("pre code").forEach((block) => {
            hljs.highlightElement(block);
        });
      } catch (error) {
          console.error('Erro ao carregar o arquivo Markdown:', error);
      }
    }
    loadMarkdown();
  });
}