# global Ember, DS, Aerowrite:true
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

###
PulpyAdmin.ApplicationSerializer = DS.RESTSerializer.extend(
    normalize: (type, hash, prop) ->
        console.log(type)
        normalizedPayload = {}
        normalizedPayload[type.typeKey] = hash
        normalizedPayload
)
###

PulpyAdmin.Router.map () ->
    @resource 'posts'

PulpyAdmin.PostsRoute = Ember.Route.extend(
    model: () ->
        @store.findAll('post')
)

PulpyAdmin.Post = DS.Model.extend(
    title: DS.attr('string'),
    intro: DS.attr('string'),
    content: DS.attr('string')
)

PulpyAdmin.Appuser = DS.Model.extend(
    email: DS.attr('string'),
    website: DS.attr('string'),
    bio: DS.attr('string'),
    twitter: DS.attr('string')
)

PulpyAdmin.PostsController = Ember.ArrayController.extend({})

PulpyAdmin.PostsView = Ember.View.extend(
  tagName: 'span'
)