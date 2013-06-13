require 'spec_helper'

describe Users::MessagesController do
  context 'when logged in' do
    before { logged_in(:user) }

    describe '#create' do
      let(:user) { create(:user) }

      context 'create a new message' do
        before { post :create, user_id: user.to_param, message: attributes_for(:message) }

          it 'should send a new message' do
          expect(user.reload.messages).to have(1).item
          expect(user.reload.messages[0].body).to eq('Hello')
        end
      end
    end
  end
end
