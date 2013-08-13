require 'spec_helper'

describe ProjectsController do
  render_views

  describe 'GET /index' do
    context 'with project' do
      let!(:projects) { 2.times.map { create(:project) } }

      before { get :index }

      it { should respond_with(:success) }

      it 'should pick up items' do
        collection = assigns(:projects)
        expect(collection).to have(2).items
        expect(collection).to include(projects[0])
        expect(collection).to include(projects[1])
      end
    end
  end

  describe 'GET /show' do
    context 'with project' do
      let!(:project) { create(:project) }

      before { get :show, id: project.to_param }

      it { should respond_with(:success) }

      it { expect(assigns(:project)).to eq(project) }
    end

    context 'without project' do
      before { get :show, id: 'invalid id' }

      it { should respond_with(404) }
    end
  end

  context 'when logged in' do
    before { logged_in }

    describe 'POST /follow' do
      let!(:project) { create(:project) }

      before { post :follow, id: project.to_param }

      it { should respond_with(:success) }

      it 'should allow current user to be as a follower of the project' do
        expect(current_user.reload.following?(project)).to be_true
      end
    end

    describe 'POST /unfollow' do
      let!(:project) { create(:project) }

      before { current_user.follow(project) }
      before { post :unfollow, id: project.to_param }

      it { should respond_with(:success) }

      it 'should allow current user to be as a follower of the project' do
        expect(current_user.reload.following?(project)).to be_false
      end
    end
  end
end

