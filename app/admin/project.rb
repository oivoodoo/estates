ActiveAdmin.register Project do
  index do
    column :name
    column :owner
    column :percent
    column :shares
    column :start_investment
    column :finish_investment
    column :created_at
    default_actions
  end

  filter :name
  filter :owner
  filter :price
  filter :start_investment
  filter :finish_investment
  filter :price
  filter :created_at

  form do |f|
    f.inputs "Details" do
      f.input :name
      f.input :image
    end
    f.inputs "Company" do
      f.input :owner
      f.input :company_image
    end
    f.inputs "Address (for showing on the google maps)" do
      f.input :country
      f.input :city
      f.input :street
    end
    f.inputs "Content" do
      f.input :description
      f.input :financials
      f.input :property
      f.input :strength
      f.input :tag_list
    end
    f.inputs "Financials" do
      f.input :price
      f.input :shares
      f.input :start_investment, :as => :string, :input_html => { :class => "hasDatetimePicker" }
      f.input :finish_investment, :as => :string, :input_html => { :class => "hasDatetimePicker" }
      f.input :target_return
      f.input :percent
      f.input :investment_type, :as => :select, :include_blank => false, :collection => [["Loan", "loan"], ["Equity", "equity"]]
    end
    f.actions
  end

  controller do
    def permitted_params
      params.permit!
    end
  end
end

