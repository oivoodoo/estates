require 'spec_helper'

describe Admin::UsersController do
  context 'when logged in' do
    before { logged_in(:admin) }

    describe 'GET #show' do
      let(:user) { create(:user) }

      before { 2.times { current_user.send_message(user, attributes_for(:message)) } }

      before { get :show, id: user.to_param }

      it { expect(assigns(:messages)).to have(2).items }
    end
  end
end

