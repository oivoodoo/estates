ActiveAdmin.register Subscription do
  index do
    column :email
    column :created_at
    default_actions
  end

  filter :email
  filter :created_at

  form do |f|
    f.input :email
    f.actions
  end

  controller do
    def permitted_params
      params.permit!
    end
  end
end

