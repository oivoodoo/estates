require 'spec_helper'

describe ProjectsSearchController do
  render_views

  describe 'get #index' do
    context 'without query' do
      let!(:projects) { 2.times.map { create(:project) } }
      before { get :index }

      it { should respond_with(:success) }

      it 'should pick up items' do
        collection = assigns(:projects)
        expect(collection).to include(projects[0])
        expect(collection).to include(projects[1])
      end
    end

    context 'search by name' do
      let!(:project1) { create(:project, name: "project") }
      let!(:project2) { create(:project, name: "project 5") }

      before { get :index, query: "project" }

      it { assigns(:projects).should == [project1, project2] }
    end

    context 'search by description' do
      let!(:project1) { create(:project, description: "lorem ipsulum") }
      let!(:project2) { create(:project, description: "lorem ipsulum dolor") }

      before { get :index, query: "lorem ipsulum" }

      it { assigns(:projects).should == [project1, project2] }
    end
  end
end
