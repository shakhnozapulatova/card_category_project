import axios from 'axios'

export default class HttpService {
  static get (url, params = {}, headers = {}) {
    return this.makeRequest(url, 'get', params, headers)
  }

  static post (url, params = {}, headers = {}) {
    return this.makeRequest(url, 'post', params, headers)
  }

  static put (url, params = {}, headers = {}) {
    return this.makeRequest(url, 'put', params, headers)
  }

  static patch (url, params = {}, headers = {}) {
    return this.makeRequest(url, 'patch', params, headers)
  }

  static delete (url, params = {}, headers = {}) {
    return this.makeRequest(url, 'delete', headers)
  }

  static makeRequest (url, method, params = {}, headers = {}) {
    const config = {
      method: method,
      url: url,
      headers: headers,
    }

    if (method === 'get') {
      config.params = params
    } else {
      config.data = params
    }

    return axios.request(config)
  }
}
