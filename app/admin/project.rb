ActiveAdmin.register Project do
  index do
    column :name
    column :owner
    column :percent
    column :start_investment
    column :finish_investment
    column :created_at
    default_actions
  end

  controller do
    def permitted_params
      params.permit!
    end
  end
end

