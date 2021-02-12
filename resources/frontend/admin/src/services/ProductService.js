import { BaseResourceService } from '@/services/BaseResourceService'

export class ProductService extends BaseResourceService {
  static get entity () {
    return 'products'
  }
}
