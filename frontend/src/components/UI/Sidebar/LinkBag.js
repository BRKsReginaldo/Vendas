import Header from './Header'
import Link from './Link'
import Collapseable from './Collapseable'

export default {
  name: 'LinkBag',
  props: {
    links: Array
  },
  methods: {
    renderLink(link, index) {
      if (typeof link === 'string') return this.$createElement(Header, {
        key: index
      }, link)

      if (!link.hasOwnProperty('links')) return this.$createElement(Link, {
        props: {
          badge: link.badge ? link.badge() : null,
          icon: link.icon,
          title: link.title,
          link: link.link
        },
        key: index
      })

      return this.$createElement(Collapseable, {
        props: {
          links: link.links,
          id: index,
          icon: link.icon,
          title: link.title
        },
        key: index
      })
    }
  },
  render(h) {
    return h('div', {
      'class': 'sidebar-nav'
    }, this.$props.links.map(this.renderLink))
  }
}