<script>
  import { mapActions, mapGetters } from 'vuex'

  export default {
    name: 'LoadProductAttributesMixin',
    computed: {
      ...mapGetters('user', ['users']),
    },
    created () {
      if (!this.users.length) {
        this.fetchUsersList()
      }
    },
    methods: {
      ...mapActions('user', ['fetchUsersList']),
    },
  }
</script>
