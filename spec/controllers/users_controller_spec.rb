require 'spec_helper'

describe UsersController do
  context 'when logged in' do
    before { logged_in(:user) }

    describe 'GET #show' do
      let(:user) { create(:user) }

      before { 2.times { current_user.send_message(user, attributes_for(:message)) } }

      before { get :show, id: user.to_param }

      it { expect(assigns(:messages)).to have(2).items }
    end

    describe 'POST /follow' do
      let!(:user) { create(:user) }

      before { post :follow, id: user.to_param }

      it { should respond_with(:success) }

      it 'should allow current user to be as a follower of the user' do
        expect(current_user.reload.following?(user)).to be_true
      end
    end

    describe 'POST /unfollow' do
      let!(:user) { create(:user) }

      before { current_user.follow(user) }
      before { post :unfollow, id: user.to_param }

      it { should respond_with(:success) }

      it 'should allow current user to be as a follower of the user' do
        expect(current_user.reload.following?(user)).to be_false
      end
    end
  end
end

