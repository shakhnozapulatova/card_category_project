import { BaseResourceService } from '@/services/BaseResourceService'

export class CategoryService extends BaseResourceService {
  static get entity () {
    return 'category'
  }
}
