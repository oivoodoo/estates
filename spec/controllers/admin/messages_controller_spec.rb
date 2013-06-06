require 'spec_helper'

describe Admin::MessagesController do
  context 'when logged in' do
    before { logged_in(:admin) }

    describe '#create' do
      let(:user) { create(:user) }

      context 'on create a new message' do
        before { post :create, user_id: user.to_param, message: attributes_for(:message) }

        it { assigns(:message).should_not be_new_record }
      end 
    end
  end
end