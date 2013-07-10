require 'spec_helper'

describe Admin::ProjectsController do
  context "when logged in" do
    before { logged_in(:admin) }

    describe '#index' do
      let!(:projects) { create_list(:project, 2) }

      before { get :index }

      it { should respond_with(:success) }

      it 'should pick up projects' do
        collection = assigns(:projects)
        expect(collection).to have(2).items
        expect(collection).to include(projects[0])
        expect(collection).to include(projects[1])
      end
    end

    describe '#show' do
      context 'with existing project' do
        let(:project) { create(:project) }

        before { get :show, id: project.to_param }

        it { should respond_with(:success) }

        it { assigns(:project).should == project }
      end

      context 'without existing project' do
        before { get :show, id: "invalid id" }

        it { should respond_with(404) }
      end
    end

    describe '#new' do
      before { get :new }

      it { should render_template(:new) }
      it { assigns(:project).should be_a(Project) }
    end

    describe '#create' do
      context "with valid attributes" do
        before { post :create, project: attributes_for(:project) }

        it { assigns(:project).should_not be_new_record }

        it { should redirect_to(admin_project_path(assigns(:project))) }
      end
    end

    describe "#edit" do
      context "with project" do
        let!(:project) { create(:project) }

        before { get :edit, id: project.to_param }

        it { assigns(:project).should == project }
      end

      context "without project" do
        before { get :edit, id: "invalid id" }

        it { should respond_with(404) }
      end
    end

    describe "#update" do
      context "with existing project" do
        let!(:project) { create(:project, name: "Estate in Cuba") }

        before { put :update, id: project.to_param, project: { name: "The best estate in Cuba" } }

        it { project.reload.name.should == "The best estate in Cuba" }

        it { should redirect_to(admin_project_path(assigns(:project))) }
      end

      context "without existing project" do
        before { get :update, id: "invalid id" }

        it { should respond_with(404) }
      end
    end

    describe '#destroy' do
      context "with existing project" do
        let!(:project) { create(:project) }

        it "should delete the project" do
          lambda {
            delete :destroy, id: project.to_param
          }.should change(Project, :count).by(-1)
        end
      end

      context "without existing project" do
        before {  delete :destroy, id: "invalid id" }

        it { should respond_with(404) }
      end
    end
  end
end
