require 'spec_helper'

describe InvestsController do
  let!(:project) { create(:project) }

  describe 'GET :new' do
    before { get :new, project_id: project.to_param }

    it { should respond_with(:success) }
    it { should render_template('new') }
  end

  describe 'POST :create' do
    before { post :create, project_id: project.to_param, invest: attributes_for(:invest) }

    it { expect(assigns(:invest).reload).not_to be_new_record }
    it { should redirect_to root_path }
  end
end
