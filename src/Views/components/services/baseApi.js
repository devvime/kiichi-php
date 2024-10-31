export const api = {
  url: 'http://localhost:8080',
  
  async get(endpoint, headers = {}) {
    return fetch(`${this.url}${endpoint}`, {
      method: 'GET',
      headers: { 'Content-Type': 'application/json', ...headers },
    }).then(this.handleResponse);
  },
  
  async post(endpoint, data = {}, headers = {}) {
    return fetch(`${this.url}${endpoint}`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', ...headers },
      body: JSON.stringify(data),
    }).then(this.handleResponse);
  },
  
  async put(endpoint, data = {}, headers = {}) {
    return fetch(`${this.url}${endpoint}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', ...headers },
      body: JSON.stringify(data),
    }).then(this.handleResponse);
  },
  
  async delete(endpoint, headers = {}) {
    return fetch(`${this.url}${endpoint}`, {
      method: 'DELETE',
      headers: { 'Content-Type': 'application/json', ...headers },
    }).then(this.handleResponse);
  },
  
  async handleResponse(response) {
    if (!response.ok) {
      const error = await response.json().catch(() => ({ message: 'Erro desconhecido' }));
      throw new Error(error.message || 'Erro desconhecido');
    }
    return response.json();
  }
};
