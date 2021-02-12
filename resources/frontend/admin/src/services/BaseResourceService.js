import Http from '@/services/HttpService'
import authConfig from '@/store/auth/utils'

export class BaseResourceService {
  static get entity () {
    throw new Error('entity getter not defined')
  }

  static createResource (params) {
    return Http.post(this.entity, params, authConfig())
  }

  static updateResource (id, params) {
    const url = this.entity + '/' + id
    return Http.put(url, params, authConfig())
  }

  static deleteResourceById (id) {
    const url = this.entity + '/' + id
    return Http.delete(url, {}, authConfig())
  }

  static getResourceById (id) {
    return Http.get(id)
  }

  static getResourceList (params = {}) {
    return Http.get(this.entity, params, authConfig())
  }

  static getUpdateForm (id) {
    const url = this.entity + '/' + id + '/edit'
    return Http.get(url, {}, authConfig())
  }

  static getCreateForm () {
    const url = this.entity + '/create'
    return Http.get(url, {}, authConfig())
  }
}
