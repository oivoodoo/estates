require 'spec_helper'

describe Admin::UsersController do
  # don't include test because of inherit_resources usage.

  describe 'GET #show' do
    let(:user) { create(:user) }

    before { get :show, id: user.to_param }

    it { expect(assigns(:message)).to be_new_record }
    it { expect(assigns(:message)).to be_a(Message) }
  end
end
