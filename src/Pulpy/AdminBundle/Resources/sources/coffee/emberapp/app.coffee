# global Ember, DS, marked
Ember.LOG_BINDINGS = true

PulpyAdmin = Ember.Application.create(
    LOG_TRANSITIONS: true,
    LOG_TRANSITIONS_INTERNAL: true,     # detailed logging of all routing steps
    LOG_ACTIVE_GENERATION: true,        # log when Ember generates a controller or a route from a generic class
    LOG_VIEW_LOOKUPS: true              # log when Ember looks up a template or a view
)

DS.RESTAdapter.reopen(
  namespace: 'api'
)

PulpyAdmin.Router.map () ->
    @resource 'posts', () ->
        @route 'view', { path: '/view/:post_id' }
    @route 'newpost'
    @route 'settings'

PulpyAdmin.PostsRoute = Ember.Route.extend(
    model: () ->
        @store.findAll('post')
)

PulpyAdmin.PostsViewController = Ember.ObjectController.extend(
    htmlbody: (->
        console.log('ICIII - ' + new upndown().convert(@get('model.content')))
        marked(@get('model.content'))
    ).property('model.content')
)

PulpyAdmin.Post = DS.Model.extend(
    title: DS.attr('string'),
    intro: DS.attr('string'),
    content: DS.attr('string'),
    author: DS.belongsTo('appuser')
)

PulpyAdmin.Appuser = DS.Model.extend(
    email: DS.attr('string'),
    website: DS.attr('string'),
    bio: DS.attr('string'),
    twitter: DS.attr('string')
)

PulpyAdmin.PostsView = Ember.View.extend(
  classNames: ['posts-view']
)

PulpyAdmin.ApplicationView = Ember.View.extend(
  classNames: ['application-view']
)

PulpyAdmin.ActivableLiComponent = Ember.Component.extend(
    tagName: 'li',
    classNameBindings: ['active'],
    active: (->
        return @get('childViews').anyBy('active')
    ).property('childViews.@each.active')
)