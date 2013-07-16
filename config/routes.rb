Estates::Application.routes.draw do
  devise_for :users, :controllers => { :omniauth_callbacks => :omniauth_callbacks, :registrations => :"users/registrations", :passwords => :"users/passwords", :sessions => :"users/sessions" }
  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  root 'home#index'

  resources :projects, only: [:index, :show] do
    member do
      get 'image'
      get 'company_image'
      post 'follow'
      post 'unfollow'
    end
    resources :comments
    resources :invests, only: :new
  end

  get 'dashboard' => 'dashboard#index'
  get 'blog' => 'blog#index', as: :blog

  resources :project_tags, only: :index
  get 'tags/:tag', to: 'projects#index', as: :tag

  resources :projects_search, only: :index do
    get 'search', :on => :collection
  end

  namespace :dashboard do
    resources :messages, only: [ :index, :show ]
  end

  resources :users, only: :show do
    scope module: 'users' do
      resources :messages, only: :create
    end
  end

  resources :contacts, only: [:new, :create]

  get 'admin' => 'admin#index', :as => 'admin'

  namespace :admin do
    resources :projects
    resources :posts

    resources :users do
      resources :messages, only: :create
    end
  end

  mount Ckeditor::Engine => '/ckeditor'
  mount GetVersion::Web => '/'
end

