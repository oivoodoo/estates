require 'spec_helper'

describe InvestsController do
  let!(:project) { create(:project) }

  describe 'GET :new' do
    before { get :new, project_id: project.to_param }

    it { should respond_with(:success) }
    it { should render_template('new') }
  end
end

