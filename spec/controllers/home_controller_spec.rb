require 'spec_helper'

describe HomeController do
  describe '#index' do
    context 'with users' do
      before { logged_in(:user) }
      let!(:users) { create_list(:user, 2) }

      before { get :index }

      it { should respond_with(:success) }

      it 'should pick up items' do
        collection = assigns(:users)
        expect(collection).to have(2).items
        expect(collection).to include(users[0])
        expect(collection).to include(users[1])
      end
    end
  end
end
