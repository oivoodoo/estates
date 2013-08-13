require 'spec_helper'

describe SettingsController do
  context 'when logged in' do
    before { logged_in(:user) }

    describe '.index' do
      before { get :index }

      it { should respond_with(:success) }
      it { should render_template('index') }
    end
  end
end

