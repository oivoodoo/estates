Estates::Application.routes.draw do
  devise_for :admin_users, ActiveAdmin::Devise.config
  ActiveAdmin.routes(self)

  devise_for :users, :controllers => { :omniauth_callbacks => :omniauth_callbacks, :registrations => :"users/registrations", :passwords => :"users/passwords", :sessions => :"users/sessions" }

  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  root 'home#index'

  resources :subscriptions, only: :create

  resources :projects, only: [:index, :show] do
    member do
      post 'follow'
      post 'unfollow'
    end
    resources :comments
    resources :investments, only: [:new, :create]
  end

  get 'dashboard' => 'dashboard#index'
  get 'settings' => 'settings#index'
  get 'blog' => 'blog#index', as: :blog

  resources :project_tags, only: :index
  get 'tags/:tag', to: 'project_tags#index', as: :tag

  resources :projects_search, only: :index do
    get 'search', :on => :collection
  end

  namespace :dashboard do
    resources :messages, only: [ :index, :show ]
  end

  resources :users, only: :show do
    member do
      post 'follow'
      post 'unfollow'
    end

    scope module: 'users' do
      resources :messages, only: :create
    end
  end
  
  devise_scope :user do
    put '/users/accreditation', to: 'users/registrations#accreditation'
  end

  resources :contacts, only: [:new, :create]

  mount GetVersion::Web => '/'
end

