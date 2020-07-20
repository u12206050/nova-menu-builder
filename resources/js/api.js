export default {
  async getItems(menuId) {
    return Nova.request().get(`/day4/nova-menu/menu/${menuId}`);
  },

  async saveItems(menuId, menuItems) {
    return Nova.request().post(`/day4/nova-menu/menu/${menuId}`, { menuItems });
  },

  async create(menuItem) {
    return Nova.request().post(`/day4/nova-menu/items`, menuItem);
  },

  async getMenuItem(menuItemId) {
    return Nova.request().get(`/day4/nova-menu/items/${menuItemId}`);
  },

  async update(menuItemId, menuItem) {
    return Nova.request().post(`/day4/nova-menu/items/${menuItemId}`, menuItem);
  },

  async destroy(menuItemId) {
    return Nova.request().delete(`/day4/nova-menu/items/${menuItemId}`);
  },

  async duplicate(menuItemId) {
    return Nova.request().post(`/day4/nova-menu/items/${menuItemId}/duplicate`);
  },

  async getLinkTypes(locale) {
    return Nova.request().get(`/day4/nova-menu/link-types/${locale}`);
  },
};
