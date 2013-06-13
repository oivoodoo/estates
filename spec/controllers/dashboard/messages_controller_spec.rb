require 'spec_helper'

describe Dashboard::MessagesController do
  before { logged_in(:user) }

  describe 'GET #index' do
    let(:bob) { create(:user) }

    before { 2.times { bob.send_message(current_user, attributes_for(:message)) } }

    before { get :index }

    it { expect(assigns(:messages)).to have(2).items }
  end
end

