Estates::Application.routes.draw do
  devise_for :users, :controllers => { :omniauth_callbacks => :omniauth_callbacks, :registrations => :"users/registrations", :passwords => :"users/passwords", :sessions => :"users/sessions" }
  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  root 'home#index'

  resources :projects, only: [:index, :show] do
    member do
      get 'image'
      post 'follow'
    end
    resources :comments
  end

  resources :project_tags, only: :index

  get 'dashboard' => 'dashboard#index'
  
  get 'tags/:tag', to: 'project_tags#index', as: :tag

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

    resources :users do
      resources :messages, only: :create
    end
  end

  # Example of regular route:
  #   get 'products/:id' => 'catalog#view'

  # Example of named route that can be invoked with purchase_url(id: product.id)
  #   get 'products/:id/purchase' => 'catalog#purchase', as: :purchase

  # Example resource route (maps HTTP verbs to controller actions automatically):
  #   resources :products

  # Example resource route with options:
  #   resources :products do
  #     member do
  #       get 'short'
  #       post 'toggle'
  #     end
  #
  #     collection do
  #       get 'sold'
  #     end
  #   end

  # Example resource route with sub-resources:
  #   resources :products do
  #     resources :comments, :sales
  #     resource :seller
  #   end

  # Example resource route with more complex sub-resources:
  #   resources :products do
  #     resources :comments
  #     resources :sales do
  #       get 'recent', on: :collection
  #     end
  #   end

  # Example resource route within a namespace:
  #   namespace :admin do
  #     # Directs /admin/products/* to Admin::ProductsController
  #     # (app/controllers/admin/products_controller.rb)
  #     resources :products
  #   end
end
