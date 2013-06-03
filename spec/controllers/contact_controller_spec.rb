require 'spec_helper'

describe ContactController do
	render_views

	describe '#new' do
		before { get :new }

		it { should respond_with(:success) }
	end
	
	describe '#create' do
		context 'on create a new contact' do
			before { post :create, contact: attributes_for(:contact) }

			it { expect(assigns(:contact).reload).not_to be_new_record }
			it { should redirect_to root_path }
		end 
	end

	describe '#create with empty fields' do
		context 'empty fields' do
			before { post :create }

			it { should respond_with(200) }
		end
	end
end
