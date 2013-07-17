ActiveAdmin.register User do
  index do
    column :name
    column :email
    column :created_at
    default_actions
  end

  filter :email
  filter :name
  filter :created_at

  controller do
    def permitted_params
      params.permit!
    end
  end
end

