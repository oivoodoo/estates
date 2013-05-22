require 'spec_helper'

describe AdminController do
  context "when logged in" do
    before { logged_in(:admin) }

    describe '#index'do
      before { get :index }

      it { should respond_with(:success) }
    end
  end

  context "when not logged in" do
    before { User.destroy_all }

    describe "#index" do
      before { get :index }

      it { should redirect_to(new_user_session_path) }
    end
  end
end
