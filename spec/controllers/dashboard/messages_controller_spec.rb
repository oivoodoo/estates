require 'spec_helper'

describe Dashboard::MessagesController do
  before { logged_in(:user) }

  describe 'GET #index' do
    let(:bob) { create(:user) }

    before { 2.times { bob.send_message(current_user, attributes_for(:message)) } }

    before { get :index }

    it { expect(assigns(:messages)).to have(2).items }
  end

  describe 'GET #show' do
    let(:bob) { create(:user) }

    before { @message = bob.send_message(current_user, attributes_for(:message)) }

    context 'viewing the received message' do
      before { get :show, id: @message.to_param }

      it { expect(@message.reload).to be_opened }
    end
  end
end

